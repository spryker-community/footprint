<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Pyz\Yves\RedirectExporter\Communication\ResourceCreator;

use SprykerFeature\Shared\Application\Communication\ControllerServiceBuilder;
use SprykerEngine\Shared\Kernel\LocatorLocatorInterface;
use Silex\Application;
use SprykerEngine\Yves\Kernel\Communication\BundleControllerAction;
use SprykerEngine\Yves\Kernel\Communication\Controller\BundleControllerActionRouteNameResolver;
use SprykerEngine\Yves\Kernel\Communication\ControllerLocator;
use Pyz\Yves\FrontendExporter\Communication\Creator\ResourceCreatorInterface;

class RedirectResourceCreator implements ResourceCreatorInterface
{

    /**
     * @var LocatorLocatorInterface
     */
    protected $locator;

    /**
     * @param LocatorLocatorInterface $locator
     */
    public function __construct(
        LocatorLocatorInterface $locator
    ) {
        $this->locator = $locator;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'redirect';
    }

    /**
     * @param Application $app
     * @param array $data
     *
     * @return array
     */
    public function createResource(Application $app, array $data)
    {
        $bundleControllerAction = new BundleControllerAction('Redirect', 'Redirect', 'redirect');
        $controllerResolver = new ControllerLocator($bundleControllerAction);
        $routeResolver = new BundleControllerActionRouteNameResolver($bundleControllerAction);

        $service = (new ControllerServiceBuilder())->createServiceForController(
            $app,
            $this->locator,
            $bundleControllerAction,
            $controllerResolver,
            $routeResolver
        );

        return [
            '_controller' => $service,
            '_route' => $routeResolver->resolve(),
            'meta' => $data,
        ];
    }

}
