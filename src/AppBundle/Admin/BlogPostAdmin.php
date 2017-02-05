<?php
// src/AppBundle/Admin/BlogPostAdmin.php
namespace AppBundle\Admin;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichFileType;

class BlogPostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Content', array('class' => 'col-md-9'))
                    ->add('title', 'text')
                    ->add('body', 'textarea')
                    ->add('imageFile', VichFileType::class)
                ->end()

                ->with('Meta data', array('class' => 'col-md-3'))
                    ->add('category', 'sonata_type_model', array(
                        'class' => Category::class,
                        'property' => 'name',
                    ))
                ->end()
            ->end()

            ->tab('Publish Options')
            // ...
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('category', null, array(), 'entity', array(
                'class'    => Category::class,
                'choice_label' => 'name', // In Symfony2: 'property' => 'name'
            ))
        ;
    }

    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, ['label' => 'Titel'])
            ->add('category.name', null, ['label' => 'Kategorie'])
            ->add('draft', null, ['label' => 'Entwurf'])
            ->add('imageFilename')
        ;
    }
}