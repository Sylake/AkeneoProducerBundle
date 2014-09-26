<?php

namespace Sylius\Bundle\SylakimBundle;

use Pim\Bundle\TransformBundle\DependencyInjection\Compiler\SerializerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle connecting Sylius and Akeneo PIM
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class SyliusSylakimBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new SerializerPass('sylius_sylakim.serializer'));
    }
}
