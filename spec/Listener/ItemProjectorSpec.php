<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use Akeneo\Component\Batch\Item\ItemProcessorInterface;
use Akeneo\Component\Batch\Item\ItemWriterInterface;
use Akeneo\Component\Batch\Job\JobParameters\DefaultValuesProviderInterface;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\StepExecutionAwareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class ItemProjectorSpec extends ObjectBehavior
{
    function let(ItemProcessorInterface $processor, ItemWriterInterface $writer)
    {
        $this->beConstructedWith($processor, $writer);
    }

    function it_projects_an_item(ItemProcessorInterface $processor, ItemWriterInterface $writer)
    {
        $item = new \stdClass();
        $processedItem = new \stdClass();

        $processor->process($item)->willReturn($processedItem);
        $writer->write([$processedItem])->shouldBeCalled();

        $this($item);
    }

    function it_projects_an_item_and_prepares_processor_if_needed(
        StepExecutionAwareInterface $processor,
        ItemWriterInterface $writer,
        DefaultValuesProviderInterface $parametersProvider
    ) {
        $item = new \stdClass();
        $processedItem = new \stdClass();

        $this->beConstructedWith($processor, $writer, $parametersProvider);

        $parametersProvider->getDefaultValues()->willReturn(['foo' => 'bar']);

        $processor->setStepExecution(Argument::that(function (StepExecution $stepExecution) {
            return $stepExecution->getJobParameters()->all() === ['foo' => 'bar'];
        }))->shouldBeCalled();;

        $processor->process($item)->willReturn($processedItem);
        $writer->write([$processedItem])->shouldBeCalled();

        $this($item);
    }
}
