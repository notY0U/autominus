<?php

namespace App\Forms;
use App\Make;
use Kris\LaravelFormBuilder\Form;

class CarForm extends Form
{
    public function buildForm()
    {
       $makes= Make::pluck('make', 'id')->all();
      
    //    dd($makes);

       $this
            ->add('make_id', 'select', [
                'label'=> 'Markė',
                'choices' => $makes,
                'empty_value' => '=== Pasirininkite markę ===',
                // 'rule' => 'required|numeric'
            ])
            ->add('year', 'number',[
                'label' => 'Pagaminimo metai'
            ])
            ->add('owner', 'text',[
                'label'=> 'Savininko vardas ir pavardė'
            ])
            ->add('prevOwners', 'number',[
                'label' => 'Viso buvusių savininkų',
                'rule' => 'nullable'
            ])
            ->add('comments', 'textarea',[
            'label' => 'Komentarai',
            ])
            ->add('submit', 'submit', ['label' => 'Save form'
            ])
            ->add('clear', 'reset', ['label' => 'Clear form']);
    }
}
