<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Feedback;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $feedback = new Feedback();
        $feedback->setName("Andreas");
        $feedback->setEmail("andreas@gmail.com");
        $feedback->setFeedback("Wonderful feedback page you have here!");
        $manager->persist($feedback);

        $manager->flush();
    }
}
