<?php

namespace App\Controller;

use App\Entity\Familia;
use App\Entity\JuegoDeTronos;
use App\Form\JuegoDeTronosType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route("/personajes/{id}", name: "showpersonajes")]
    public function getPersonajes($id, EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(JuegoDeTronos::class);
        $personajes = $repository->find($id);

        return $this->render("personajes/showPersonajes.html.twig", ["personaje" => $personajes]);
    }

    #[Route("/characters", name: "getcharacters")]
    public function getCharacters(EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(JuegoDeTronos::class);
        $characters = $repository->findAll();
        return $this->render("personajes/listCharacters.html.twig", ["characters" => $characters]);
    }

    #[Route("/insert/character")]
    public function insertCharacter(EntityManagerInterface $doctrine)
    {

        $familia1 = new Familia();
        $familia1->setName("House Targaryen");

        $familia2 = new Familia();
        $familia2->setName("House Tarly");

        $familia3 = new Familia();
        $familia3->setName("House Stark");

        $familia4 = new Familia();
        $familia4->setName("House Baratheon");

        $familia5 = new Familia();
        $familia5->setName("House Lannister");

        $familia6 = new Familia();
        $familia6->setName("House Clegane");


        $character1 = new JuegoDeTronos();
        $character1->setName("Tyrion Lannister");
        $character1->setDescription("Lord Tyrion Lannister is the youngest child of Lord Tywin Lannister and younger brother of Cersei and Jaime Lannister. A dwarf, he uses his wit and intellect to overcome the prejudice he faces.");
        $character1->setImage("https://thronesapi.com/assets/images/tyrion-lannister.jpg");
        $character1->setNumber(7);
        $character1->addFamilia($familia5);

        $character2 = new JuegoDeTronos();
        $character2->setName("Cersei Lannister");
        $character2->setDescription("Queen Cersei I Lannister is the widow of King Robert Baratheon and Queen of the Seven Kingdoms. She is the daughter of Lord Tywin Lannister, twin sister of Jaime Lannister and elder sister of Tyrion Lannister.");
        $character2->setImage("https://thronesapi.com/assets/images/cersei.jpg");
        $character2->setNumber(6);
        $character2->addFamilia($familia5);

        $character3 = new JuegoDeTronos();
        $character3->setName("Jamie Lannister");
        $character3->setDescription("Ser Jaime Lannister is the eldest son of Tywin Lannister. With Cersei's ascension to the Iron Throne, Jaime was appointed as the new commander of the Lannister armies but left the position to honor and help the North face the White Walkers");
        $character3->setImage("https://thronesapi.com/assets/images/jaime-lannister.jpg");
        $character3->setNumber(5);
        $character3->addFamilia($familia5);

        $character4 = new JuegoDeTronos();
        $character4->setName("Arya Stark");
        $character4->setDescription("Arya Stark is the third child of Eddard Stark and Catelyn Stark. After narrowly escaping the persecution of House Stark by House Lannister, Arya is trained as a Faceless Man at the House of Black and White in Braavos, and uses her new skills to bring those who have wronged her family to justice.");
        $character4->setImage("https://thronesapi.com/assets/images/arya-stark.jpg");
        $character4->setNumber(4);
        $character4->addFamilia($familia3);

        $character5 = new JuegoDeTronos();
        $character5->setName("Jon Snow");
        $character5->setDescription("Jon Snow, born Aegon Targaryen, is the son of Lyanna Stark and Rhaegar Targaryen, the late Prince of Dragonstone. After successfully capturing a wight and presenting it to the Lannisters as proof that the Army of the Dead are real, Jon pledges himself and his army to Daenerys Targaryen");
        $character5->setImage("https://thronesapi.com/assets/images/jon-snow.jpg");
        $character5->setNumber(3);
        $character5->addFamilia($familia3);

        $character6 = new JuegoDeTronos();
        $character6->setName("Samwell Tarly");
        $character6->setDescription("Samwell Tarly is a steward in the Night's Watch and is Jon Snow's closest friend. Though he is not the bravest or the most skilled of men, he is intelligent, well-educated, and insightful, his vast knowledge serving the Night's Watch well in their battles with the forces beyond the Wall");
        $character6->setImage("https://thronesapi.com/assets/images/sam.jpg");
        $character6->setNumber(1);
        $character6->addFamilia($familia2);

        $character7 = new JuegoDeTronos();
        $character7->setName("Daenerys");
        $character7->setDescription("Queen Daenerys I Targaryen is the younger sister of Rhaegar Targaryen and Viserys Targaryen, the paternal aunt of Jon Snow, and the youngest child of King Aerys II Targaryen and Queen Rhaella Targaryen, who were both ousted from the Iron Throne during Robert Baratheon's rebellion");
        $character7->setImage("https://thronesapi.com/assets/images/daenerys.jpg");
        $character7->setNumber(0);
        $character7->addFamilia($familia1);

        $doctrine->persist($familia1);
        $doctrine->persist($familia2);
        $doctrine->persist($familia3);
        $doctrine->persist($familia5);
        $doctrine->persist($character1);
        $doctrine->persist($character2);
        $doctrine->persist($character3);
        $doctrine->persist($character4);
        $doctrine->persist($character5);
        $doctrine->persist($character6);
        $doctrine->persist($character7);
        $doctrine->flush();
        return new Response("Character insertados correctamente");
    }

    #[Route("/new/character", name: "createcharcter")]
    public function newCharacter(Request $request, EntityManagerInterface $doctrine)
    {
        $form = $this->createForm(JuegoDeTronosType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $JuegoDeTronos = $form->getData();
            $doctrine->persist($JuegoDeTronos);
            $doctrine->flush();
            $this->addFlash("exito", "character creado correctamente!!");
            return $this->redirectToRoute("getcharacters");
        }
        return $this->renderForm("personajes/newCharacter.html.twig", ["juegosForm" => $form]);
    }

    #[Route("/edit/character/{id}", name: "editcharacter")]
    #[IsGranted("ROLE_USER")]
    public function editCharacter(Request $request, EntityManagerInterface $doctrine, $id)
    {
        $repository = $doctrine->getRepository(JuegoDeTronos::class);
        $personajes = $repository->find($id);
        $form = $this->createForm(JuegoDeTronosType::class, $personajes);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $JuegoDeTronos = $form->getData();
            $doctrine->persist($JuegoDeTronos);
            $doctrine->flush();
            $this->addFlash("exito", "character creado correctamente!!");
            return $this->redirectToRoute("getcharacters");
        }
        return $this->renderForm("personajes/newCharacter.html.twig", ["juegosForm" => $form]);
    }

    #[Route("/remove/character/{id}", name: "removecharacter")]
    public function removecharacter($id, EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(JuegoDeTronos::class);
        $personajes = $repository->find($id);

        $doctrine->persist($personajes);
        $doctrine->flush();

        $this->addFlash("exito", "character borrado correctamente!!");
        return $this->redirectToRoute("getcharacters");
    }
}
