<?php


namespace Contract;


interface CommandInterface
{
/**
 * Выполнение команды
 */

public function execute(): void;
}