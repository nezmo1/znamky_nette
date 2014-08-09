<?php

use Nette\Application\UI\Form;



class ZakazkaPresenter extends BasePresenter
{


    /** @var Nette\Database\Connection */
    private $connection;

    public function injectConnection(Nette\Database\Connection $connection)
    {
        $this->connection = $connection;
    }


    protected function startup()
    {
        parent::startup();

    }


    // hlavní metoda, která inicializuje celý datagrid. Zavolá se v šabloně latte
    // na místě kde je {control datagrid}. V této metodě se určují sloupce, formuláře
    // atd. Na konci jsou uvedeny cesty, které u jiné instalace nemusí souhlasit
    public function createComponentDatagrid()
    {
        $grid = new Vendor\Nextras\Datagrid\Datagrid;
        $grid->addColumn('id');
        $grid->addColumn('zakazkanazevdilu')->enableSort();
        $grid->addColumn('neco')->enableSort();
        $grid->addColumn('virtual-neco', 'Operace');

        $grid->setDataSourceCallback($this->getData);

        $grid->setFilterFormFactory(function() {
            $form = new Nette\Forms\Container;
            $form->addText('zakazkanazevdilu');
            $form->addSelect('neco', NULL, array(
                'male' => 'železo',
                'female' => 'dřevo',
            ))->setPrompt('---');

            return $form;
        });

        $grid->setEditFormFactory(function($row) {
            $form = new Nette\Forms\Container;
            $form->addText('zakazkanazevdilu');
            !$row ?: $form->setDefaults($row);
            return $form;
        });



        $grid->setEditFormCallback($this->saveData);

        $grid->addCellsTemplate(__DIR__ . '/../../libs/Nextras/datagrid/bootstrap-style/@bootstrap3.datagrid.latte');
        $grid->addCellsTemplate(__DIR__ . '/../../libs/Nextras/datagrid/bootstrap-style/@cells.latte');
        return $grid;
    }

    // metoda pro načtení dat, zpracovává filtry i požadavky na třídění
    public function getData($filter, $order)
    {
        $filters = array();
        foreach ($filter as $k => $v) {
            if ($k === 'neco')
                $filters[$k] = $v;
            else
                $filters[$k. ' LIKE ?'] = "%$v%";
        }

        $selection = $this->connection->table('zakazka')->where($filters);
        if ($order) {
            $selection->order(implode(' ', $order));
        }

        return $selection->limit(30);
    }


    // metoda pro uložení dat
    public function saveData($data)
    {
	$data = $data->getValues();
	$this->connection->table('zakazka')->where('id', $data->id)->update($data);
	$this->flashMessage('Data ulozena.');
	$this->invalidateControl('flashes');
    }




    public function renderDefault()
    {


    }

}
