<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity
 */
class VerbFactory
{
    private const ROUTE_TO_FORM_MAP = [
        'add_modo_indicativo' => TimeTypes::MODO_INDICATIVO,
        'add_preterio_simple' => TimeTypes::PRETERIO_SIMPLE,
        'add_futuro_simple' => TimeTypes::FUTURO_SIMPLE,
    ];

    /** EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(string $type): AbstractTimeForm
    {
        $meta = $this->entityManager->getMetadataFactory()->getMetadataFor(AbstractTimeForm::class);
        $discriminatorMap = $meta->discriminatorMap;
        $verbClassName = $discriminatorMap[$type];

        if (!$verbClassName) {
            throw new \RuntimeException('There\'s no Class for type ' . $type);
        }

        $verbObject = new $verbClassName();

        if (!$verbObject instanceof AbstractTimeForm) {
            throw new \RuntimeException('Class ' . get_class($verbObject) . ' for type ' . $type . ' should be instance of ' . AbstractTimeForm::class);
        }

        return $verbObject;
    }

    public function createFromRequest(Request $request): AbstractTimeForm
    {
        return $this->create(self::ROUTE_TO_FORM_MAP[$request->attributes->get('_route')]);
    }
}
