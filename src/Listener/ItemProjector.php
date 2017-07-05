<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Akeneo\Component\Batch\Item\ItemProcessorInterface;
use Akeneo\Component\Batch\Item\ItemWriterInterface;
use Akeneo\Component\Batch\Job\JobParameters;
use Akeneo\Component\Batch\Job\JobParameters\DefaultValuesProviderInterface;
use Akeneo\Component\Batch\Model\JobExecution;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\StepExecutionAwareInterface;

final class ItemProjector implements ItemProjectorInterface
{
    /** @var ItemProcessorInterface */
    private $processor;

    /** @var ItemWriterInterface */
    private $writer;

    /** @var DefaultValuesProviderInterface|null */
    private $parametersProvider;

    public function __construct(
        ItemProcessorInterface $processor,
        ItemWriterInterface $writer,
        DefaultValuesProviderInterface $valuesProvider = null
    ) {
        $this->processor = $processor;
        $this->writer = $writer;
        $this->parametersProvider = $valuesProvider;
    }

    public function __invoke($item)
    {
       if ($this->processor instanceof StepExecutionAwareInterface) {
           $jobExecution = new JobExecution();
           $jobExecution->setJobParameters(new JobParameters($this->parametersProvider->getDefaultValues()));

           $stepExecution = new StepExecution('42', $jobExecution);

           $this->processor->setStepExecution($stepExecution);
       }

       $this->writer->write([$this->processor->process(clone $item)]);
    }
}
