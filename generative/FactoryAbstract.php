<?php

namespace generative;

interface FactoryAbstract
{
    public static function makeDeveloperWorker(): DeveloperWorker;
    public static function makeDesignerWorker(): DesignerWorker;

}

class OutsourceWorkerFactory implements FactoryAbstract
{
    public static function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

}

class NativeWorkerFactory implements FactoryAbstract
{
    public static function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

}


interface Worker
{
    public function work();

}
interface DeveloperWorker extends Worker
{

}

interface DesignerWorker extends Worker
{

}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf("I'm is development as all time");
    }

}
class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf("I'm is designer as all time");
    }

}
class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf("I'm is development as outsource");
    }

}
class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf("I'm is designer as outsource");
    }

}