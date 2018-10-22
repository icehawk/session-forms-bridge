<?php declare(strict_types=1);
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

namespace IceHawk\Bridges\SessionForms\Tests\Unit;

use IceHawk\Bridges\SessionForms\AbstractSession;
use IceHawk\Forms\FormId;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractSessionTest
 * @package IceHawk\Bridges\SessionForms\Tests\Unit
 */
class AbstractSessionTest extends TestCase
{
	/** @var array */
	private $sessionData;

	/** @var AbstractSession */
	private $sessionInstance;

	public function setUp()
	{
		$sessionData           = [AbstractSession::FORMS => []];
		$this->sessionData     = &$sessionData;
		$this->sessionInstance = new class($sessionData) extends AbstractSession
		{
		};
	}

	/**
	 * @throws \PHPUnit\Framework\ExpectationFailedException
	 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
	 */
	public function testCanGetNewFormInstance()
	{
		$formId = new FormId( 'unit.test' );

		$this->assertArrayNotHasKey( $formId->toString(), $this->sessionData[ AbstractSession::FORMS ] );

		$form = $this->sessionInstance->getForm( $formId );

		$this->assertArrayHasKey( $formId->toString(), $this->sessionData[ AbstractSession::FORMS ] );
		$this->assertSame( $formId, $form->getFormId() );
	}

	/**
	 * @throws \PHPUnit\Framework\ExpectationFailedException
	 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
	 */
	public function testCanGetExistingInstance()
	{
		$formId = new FormId( 'unit.test' );
		$form   = $this->sessionInstance->getForm( $formId );

		$existingForm = $this->sessionInstance->getForm( $formId );
		$this->assertSame( $form, $existingForm );
	}

	/**
	 * @throws \PHPUnit\Framework\ExpectationFailedException
	 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
	 */
	public function testCanUnsetOneForm()
	{
		$formId = new FormId( 'unit.test' );
		$form   = $this->sessionInstance->getForm( $formId );

		$this->sessionInstance->unsetForm( $formId );

		$newForm = $this->sessionInstance->getForm( $formId );

		$this->assertNotSame( $form, $newForm );
	}

	/**
	 * @throws \PHPUnit\Framework\ExpectationFailedException
	 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
	 */
	public function testCanUnsetAllForms()
	{
		$formId1 = new FormId( 'unit.test.1' );
		$formId2 = new FormId( 'unit.test.2' );

		$form1 = $this->sessionInstance->getForm( $formId1 );
		$form2 = $this->sessionInstance->getForm( $formId1 );

		$this->sessionInstance->unsetAllForms();

		$newForm1 = $this->sessionInstance->getForm( $formId1 );
		$newForm2 = $this->sessionInstance->getForm( $formId2 );

		$this->assertNotSame( $form1, $newForm1 );
		$this->assertNotSame( $form2, $newForm2 );
	}
}
