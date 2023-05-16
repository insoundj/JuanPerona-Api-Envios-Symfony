<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class EnvioAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            //->add('id')
            ->add('uuid')
            ->add('recogida')
            ->add('destino')
            ->add('localizador')
            //->add('vehiculo', null, ['label' => 'Vehículo'])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('uuid')
            ->add('recogida')
            ->add('destino')
            ->add('localizador')
            ->add('vehiculo', null, ['label' => 'Vehículo'])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            //->add('id')
            ->add('uuid')
            ->add('recogida', CollectionType::class)
            ->add('destino', CollectionType::class)
            ->add('localizador')
            ->add('vehiculo', ChoiceType::class, [
                'label' => 'Vehículo',
                'choices'  => [
                    'Selecciona' => '',
                    'coche' => 'coche',
                    'furgoneta' => 'furgoneta',
                    'compartido' => 'compartido',
                ],
                'required' => true             
                ])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('uuid')
            ->add('recogida')
            ->add('destino')
            ->add('localizador')
            ->add('vehiculo', null, ['label' => 'Vehículo'])
            ->add('user', ModelListType::class, ['label' => 'Usuario'])
            ;
    }
}
