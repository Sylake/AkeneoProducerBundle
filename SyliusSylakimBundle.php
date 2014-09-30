<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylakim
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\SylakimBundle;

use Pim\Bundle\TransformBundle\DependencyInjection\Compiler\SerializerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle connecting Sylius and Akeneo PIM
 *
 * @author Romain Monceau <romain@akeneo.com>
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
