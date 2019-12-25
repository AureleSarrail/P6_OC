<?php


namespace App\Service;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AddCommentService
{
    private $em;
    private $userRepo;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo)
    {
        $this->em = $em;
        $this->userRepo = $userRepo;
    }

    public function addComment(Comment $comment, Trick $trick, User $user)
    {
        $comment->setTrick($trick)
            ->setCreatedAt(new \DateTime())
            ->setUser($user);

        $this->em->persist($comment);
        $this->em->flush();
    }
}