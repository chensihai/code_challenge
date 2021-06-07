<?php

namespace Drupal\code_challenge\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'ACMcmeSportsBlock' block.
 *
 * @Block(
 *  id = "acmcme_sports_block",
 *  admin_label = @Translation("Acmcme sports block"),
 * )
 */
class ACMcmeSportsBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Config\ConfigManagerInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigManagerInterface
   */
  protected $configManager;

  /**
   * Drupal\Core\Cache\Context\CacheContextsManager definition.
   *
   * @var \Drupal\Core\Cache\Context\CacheContextsManager
   */
  protected $cacheContextsManager;

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->configManager = $container->get('config.manager');
    $instance->cacheContextsManager = $container->get('cache_contexts_manager');
    $instance->httpClient = $container->get('http_client');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */

    public function build() {
        $items = array();
        $config = \Drupal::config('code_challenge.codechallenge');
        
        $mURL = $config->get('api_endpoint');
        $meta =  $config->get('meta_message');
        
        $result= file_get_contents($mURL);
        $data=json_decode($result);
        $items=$data->results->data->team;
        //var_dump($data);  //$data->results->columns
        return array(
            '#content' =>['rows'=>(array) $items,   'header'=>(array)$data->results->columns],  
            '#theme' => 'acmcme_sports_block',
            'acmcme_sports_block' => array(
                '#markup'=>'Implement ACMcmeSportsBlock',
            ),
            '#attached' => array(
                'library' => array('code_challenge/code_challenge-library'),
            ),
        );
    }
}
