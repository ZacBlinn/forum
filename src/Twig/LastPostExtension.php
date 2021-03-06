<?php

namespace App\Twig;

use App\Entity\Topic;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class LastPostExtension extends AbstractExtension
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * GetProvinceExtension constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): ?array
    {
        return [
            new TwigFunction('lastPostByCategory', [$this, 'getLastPostByCategory']),
        ];
    }

    public function getLastPostByCategory($category)
    {
        $post = $this->em->getRepository(Topic::class)->findLastPostByCategory($category);

        return $post;
    }
}
