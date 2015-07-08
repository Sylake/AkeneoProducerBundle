<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylake\Bundle\SylakimBundle\Client\Adapter;

/**
 * Client interface used to call the Sylius API
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 * @author Arnaud Langlade <arn0d.dev@gmail.com>
 */
interface ClientAdapterInterface
{
    public function get($resource, array $params = []);
    public function create($resource, array $params = []);
    public function update($resource, array $params = []);
    public function delete($resource, array $params = []);
}
