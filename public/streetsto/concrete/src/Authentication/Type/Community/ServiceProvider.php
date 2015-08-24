<?php
namespace Concrete\Core\Authentication\Type\Community;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\SymfonySession;
use OAuth\ServiceFactory;
use OAuth\UserData\ExtractorFactory;

class ServiceProvider extends \Concrete\Core\Foundation\Service\Provider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /** @var ExtractorFactory $factory */
        $factory = $this->app->make('oauth/factory/extractor');
        $factory->addExtractorMapping('Concrete\\Core\\Authentication\\Type\\Community\\Service\\Community',
                                      'Concrete\\Core\\Authentication\\Type\\Community\\Extractor\\Community');

        $factory = $this->app->make('oauth/factory/service');
        $factory->registerService('community', '\\Concrete\\Core\\Authentication\\Type\\Community\\Service\\Community');

        unset($factory);

        $this->app->bindShared(
            'authentication/community',
            function ($app, $callback = '/ccm/system/authentication/oauth2/community/callback/') {
                /** @var ServiceFactory $factory */
                $factory = $app->make('oauth/factory/service');

                return $factory->createService(
                    'community',
                    new Credentials(
                        \Config::get('auth.community.appid'),
                        \Config::get('auth.community.secret'),
                        BASE_URL . \URL::to($callback)
                    ),
                    new SymfonySession(\Session::getFacadeRoot(), false));
            });
    }

}
