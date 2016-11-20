<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace IceHawk\Bridges\SessionForms;

use IceHawk\Forms\Form;
use IceHawk\Forms\Interfaces\IdentifiesForm;
use IceHawk\Session\AbstractSession as BaseSession;

/**
 * Class AbstractSession
 * @package IceHawk\Bridges\SessionForms
 */
abstract class AbstractSession extends BaseSession
{
	const FORMS = 'forms';

	public function getForm( IdentifiesForm $formId ) : Form
	{
		$forms = $this->get( self::FORMS ) ? : [];

		if ( !isset($forms[ $formId->toString() ]) )
		{
			$forms[ $formId->toString() ] = new Form( $formId );
			$this->set( self::FORMS, $forms );
		}

		return $forms[ $formId->toString() ];
	}

	public function unsetForm( IdentifiesForm $formId )
	{
		$forms = $this->get( self::FORMS ) ? : [];

		unset($forms[ $formId->toString() ]);

		$this->set( self::FORMS, $forms );
	}

	public function unsetAllForms()
	{
		$this->unset( self::FORMS );
	}
}
