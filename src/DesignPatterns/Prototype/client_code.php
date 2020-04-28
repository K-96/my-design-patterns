<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DesignPatterns\Prototype\BusinessProcessFlow;
use DesignPatterns\Prototype\Steps\End;
use DesignPatterns\Prototype\Steps\IfStep;
use DesignPatterns\Prototype\Steps\SendEmail;
use DesignPatterns\Prototype\Steps\SendSms;
use DesignPatterns\Prototype\Steps\Start;

$start = new Start();
$end = new End();

$bpf = new BusinessProcessFlow($start, $end);
$bpf->addStep(new IfStep());
$bpf->addStep(new SendEmail());
$bpf->addStep(new IfStep());
$bpf->addStep(new SendSms());

$bpf2 = clone $bpf;

$start->text = 'changed';
$end->text = 'changed';
