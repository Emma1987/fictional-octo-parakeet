<?php

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Website;
use Eckinox\AdminUiBundle\Form\Type\SectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebsiteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add($builder->create('website', SectionType::class)
				->add('name', TextType::class, [

				])
				->add('url', TextType::class, [

				])
				->add('category', EntityType::class, [
					'class' => Category::class,
					'choice_label' => 'name',
				])
			)
			->add('save', SubmitType::class)
		;
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'data_class' => Website::class,
			'attr' => [
				'data-widget' => 'form-validate',
			],
		]);
	}
}
