<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
// manjeador de bd, y entidad.
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\PaisesGuardados;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ScannerPaisesController extends AbstractController
{
    private $client; // cliente interface
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;  // cargamos el cleinte
    }
    public function fetchApiPaises( $commando ): array
    {
        $response = $this->client->request(
            'GET',
            'https://restcountries.com/v3.1/' . $commando  // conectando a la api...
        );
        $content = $response->getContent();
        $content = $response->toArray();  // parseamos a un array
        return $content;
    }
    /**
     * @Route("/", name="home")
     */
    public function home() { 
         return $this->redirect('/codigoPais=ES');
        // return new Response('hello');
    } 
    /**
     * @Route("/codigoPais={codigoPaisBuscar}", name="scanner_paises")
     */
    public function index( ManagerRegistry $doctrine , $codigoPaisBuscar ) 
    {       
        if(empty($codigoPaisBuscar)) { $codigoPaisBuscar = 'ES'; } // chekeamos integridad
        $paisesGuardados = $doctrine->getRepository(PaisesGuardados::class)->findAll(); // fetch paises
        // renderizamos
        return $this->render('scanner_paises/index.html.twig', [
            'listaPaises'       => $this->fetchApiPaises('all'), // todos los paises API
            'paisesGuardados'   => $paisesGuardados,             // datos en la tabla
            'paisEncontrado'    => $this->fetchApiPaises('alpha/'. $codigoPaisBuscar) // pais especifico
        ]);
    }
     /**
     * @Route("/guardarPais/nombre={nombrePais}&codigo={codigoPaisGuardar}", name="guardarPais" ,methods={"GET","HEAD"})
     */     
    public function guardarPais( ManagerRegistry $doctrine, $nombrePais, $codigoPaisGuardar )
    {
        // el managers
        $entityManager = $doctrine->getManager();
        $nuevoPais     = new PaisesGuardados();  
        $nuevoPais->setNombre( $nombrePais ); // agregamos el nombre 
        $nuevoPais->setCodigo( $codigoPaisGuardar ); // agregamos el nombre al pais
        $entityManager->persist($nuevoPais);
        $entityManager->flush(); // ejecutamos
        return $this->redirect('/codigoPais=' . $codigoPaisGuardar);
    }
    /**
     * @Route("/removerPais/{idPaisGuardado}", name="removerPais" ,methods={"GET","HEAD"})
     */     
    public function removerPais( $idPaisGuardado ,  ManagerRegistry $doctrine ) : Response
    {
        $entityManager = $doctrine->getManager(); // el manager
        $paisGuardado  = $doctrine->getRepository(PaisesGuardados::class)->findOneBy(['id' => $idPaisGuardado]);
        // si no hay paises guardados
        if (!$paisGuardado) { 
           return $this->redirect('/codigoPais=ES&mensaje=no_hay_paises_guardados');
         }
       // elimianmos el pais de l abase de datos
        $entityManager->remove($paisGuardado);
        $entityManager->flush();
        // redireccionamos a la ruta con lso paises guardados
        return $this->redirect('/codigoPais=ES');
    }
}
