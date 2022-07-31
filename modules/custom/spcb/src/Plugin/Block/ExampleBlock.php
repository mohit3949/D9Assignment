<?php
namespace Drupal\spcb\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\spcb\MyServices;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class ExampleBlock extends BlockBase implements ContainerFactoryPluginInterface {

   // store service
  protected $mm = NULL;
  

  /*
   * static create function provided by the ContainerFactoryPluginInterface.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('spcb.test')
    );
  }

    /*
   * BlockBase plugin constructor that's expecting the HelloServices object provided by create().
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MyServices $mm) {
    // instantiate the BlockBase parent first
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    
    // then save the my service passed to this constructor via dependency injection
    $this->mm = $mm;
  } 

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = \Drupal::getContainer()->get('config.factory')->getEditable('spcb.adminsettings');  

    return [
    '#theme' => 'custom_block',
	'#title' => 'Cache Invalidation Block Assignment',
    '#current_time' => $this->mm->get_currenttime(),
    '#country' => $config->get('country'),
    '#city' => $config->get('city'),
    '#cache' => [
         'tags' => [
            'config:spcb.adminsettings'   
         ],   
       ],
    ];
  }

  


  

}
