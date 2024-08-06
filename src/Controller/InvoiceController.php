<?php

namespace App\Controller;
use App\Repository\OrderRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvoiceController extends AbstractController
{
    /**
     * IMPRESSION FACTURE PDF pour un utilisateur connecté
     * Vérification de la commande pour un utilisateur donné
     */
    #[Route('/compte/facture/impression/{id_order}', name: 'app_invoice')]
    public function index(OrderRepository $orderRepository, $id_order): Response
    {
        // 1. Vérification de l'objet commande - Existe ?
        $order = $orderRepository->findOneById($id_order);

        if (!$order) {
            return $this->redirectToRoute('app_account');
        }

        // 2. Vérification de l'objet commande - Ok pour l'utilisateur
        if ($order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('app_account');
        }

        $dompdf = new Dompdf();
        $html = $this->renderView('invoice/index.html.twig', [
            'order' => $order
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('facture.pdf', [
            'Attachment' => false
        ]);

        exit();
    }
}
