<?php

namespace App\EntityListener;

use App\Entity\Article;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEntityListener(event: Events::prePersist, entity: Article::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Article::class)]
class ArticleEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    public function __invoke(Article $article)
    {
        $article->setSlug($this->slugger->slug($article->getTitle()));
    }
}