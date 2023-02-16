<?php

namespace App\Form\Type;

use App\Entity\Review;
use Eckinox\AdminUiBundle\Form\Type\SectionType;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add($builder->create('review', SectionType::class)
				->add('comment', TinymceType::class, [])
				->add('rating', NumberType::class, [
					'html5' => true,
					'scale' => 2,
					'row_attr' => ['class' => ''],
				])
			)
			->add('save', SubmitType::class, [
				'row_attr' => ['class' => 'd-flex justify-content-end'],
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'data_class' => Review::class,
			'attr' => [
				'data-widget' => 'form-validate',
			],
		]);
	}
}
