<?php

namespace App\Service;
use App\Entity\Section;
use App\Enum\Statuses;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MenuBuilderService
{

    public function __construct(
        private CacheInterface $cache,
        private EntityManagerInterface $entityManager,
        private KernelInterface $kernel
    )
    {}

    public function getCatalogMenu(): array
    {
        $catalogRootId = 8;
        $images = [
            '9' => [
                'image' => '844d7696accf071405a215bf3cdedda4.png',
                'imageXs' => '29a7003809dbd7f79e29902cea1ba6d2.png',
            ],
            '10' => [
                'image' => '4de621ec964168162cdaf2e6ef390569.jpg',
                'imageXs' => '8eb8d288c6794b56b4191f7976b16239.png',
            ],
            '11' => [
                'image' => 'e24207c896c356608fb0495f25a3fafe.png',
                'imageXs' => 'e24207c896c356608fb0495f25a3fafe.png',
            ],
            '12' => [
                'image' => '2bf064154f42e0df9680477902ef8a1b.png',
                'imageXs' => '2bf064154f42e0df9680477902ef8a1b.png',
            ],
            '13' => [
                'image' => 'a5c88e63227acecf59949a74da9baf92.png',
                'imageXs' => 'a5c88e63227acecf59949a74da9baf92.png',
            ],
            '14' => [
                'image' => '51a53eedbda0239c74e976ee7234d8b2.png',
                'imageXs' => '51a53eedbda0239c74e976ee7234d8b2.png',
            ],
            '15' => [
                'image' => 'd6b2cf2a89ad5bc4c85326cb53e58fdc.png',
                'imageXs' => 'd6b2cf2a89ad5bc4c85326cb53e58fdc.png',
            ],
            '16' => [
                'image' => '384c25fdea6ec7a31fac87a29d1030af.png',
                'imageXs' => '384c25fdea6ec7a31fac87a29d1030af.png',
            ],
            '17' => [
                'image' => 'c96a00a86b19071cb6653376823e495a.png',
                'imageXs' => 'c96a00a86b19071cb6653376823e495a.png',
            ],
            '18' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '19' => [
                'image' => '56491ba78fa466ef3da562f2beb1e9fe.png',
                'imageXs' => '56491ba78fa466ef3da562f2beb1e9fe.png',
            ],
            '20' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '21' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '22' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '23' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '24' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '25' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '26' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '27' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
            '28' => [
                'image' => '97051bedbacfa2a4c175cd73d6da9f94.png',
                'imageXs' => '97051bedbacfa2a4c175cd73d6da9f94.png',
            ],
        ];


        $repo = $this->entityManager->getRepository(Section::class)
        ;
//        return $this->cache->get('catalog_menu', function(ItemInterface $item)  use ($catalogRootId, $repo) {

//            if ($this->kernel->getEnvironment() === 'dev') {
//                $item->expiresAfter(1); // 1 секунда для dev
//                dd($catalogRootId);
//            }
            $categories = $repo->findBy([
                'parent' => $catalogRootId,
//                'status' => Statuses::Active
            ],
                [
                    'ord' => 'ASC',
                    'id' => 'ASC',
                ]
            );

            $result = [];
            foreach($categories as $category)
            {
                $subCategories = $repo->findBy(
                    [
                    'parent' => $category->getId(),
                    ],
                    [
                        'ord' => 'ASC',
                        'id' => 'ASC',
                    ]
                );
                $childs = [];
                foreach($subCategories as $subCategory)
                {
                    $childs[] = [
                        'label' => $subCategory->getTitle(),
                        'route' => 'index',
                        'fullPath' => $subCategory->getFullPath(),
                        'image' => $images[$subCategory->getId()]['image'],
                        'imageXs'=> $images[$subCategory->getId()]['imageXs'],
                        'is_fav'=> true,
                        'children' => [],
                    ];
                }
                $result[] = [
                    'label' => $category->getTitle(),
                    'route' => 'index',
                    'fullPath' => $category->getFullPath(),
                    'image' => $images[$category->getId()]['image'],
                    'imageXs'=> $images[$category->getId()]['imageXs'],
                    'is_fav'=> true,
                    'children' => $childs,
                ];
            };
            return $result;
//        });

    }

}
