<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Drupal\DrupalExtension\Context\RawDrupalContext;
use Drupal\rdf_entity\RdfInterface;
use Drupal\user\UserInterface;

/**
 * Defines step definitions specifically for testing the RDF entities.
 */
class RdfEntityContext extends RawDrupalContext {

  /**
   * User creation and login for creating RDF entities.
   *
   * A custom step that creates a user that has the permissions to manage and
   * view RDF entities of a give type.
   *
   * @Given I am logged in with a user that can access the RDF content overview page
   */
  public function assertLoggedInWithRdfEntityTypePermissions(): void {
    $permissions = [
      'view rdf entity',
      'view rdf entity overview',
    ];

    $role = $this->getDriver()->roleCreate($permissions);

    // Create user.
    $user = (object) [
      'name' => $this->getRandom()->name(8),
      'pass' => $this->getRandom()->name(16),
      'role' => $role,
    ];
    $user->mail = "{$user->name}@example.com";
    $this->userCreate($user);

    // Assign the temporary role with given permissions.
    $this->getDriver()->userAddRole($user, $role);
    $this->roles[] = $role;

    // Login.
    $this->login($user);
  }

  /**
   * Asserts that the current user has access to a given RDF entity.
   *
   * @Then I should have :operation access to the RDF entity with the name :name
   */
  public function assertAccessToTheRdfEntityWithTheName(string $operation, string $name): void {
    $entity = $this->loadRdfEntityByName($name);
    $current_user = $this->getCurrentUser();
    if (!$entity->access($operation, $current_user)) {
      throw new \Exception('The current user does not have access for this operation and they should.');
    }
  }

  /**
   * Asserts that the current user does not have access to a given RDF entity.
   *
   * @Then I should not have :operation access to the RDF entity with the name :name
   */
  public function assertNoAccessToTheRdfEntityWithTheName(string $operation, string $name): void {
    $entity = $this->loadRdfEntityByName($name);
    $current_user = $this->getCurrentUser();
    if ($entity->access($operation, $current_user)) {
      throw new \Exception('The current user has access for this operation and they should not.');
    }
  }

  /**
   * Loads an RDF entity by name.
   *
   * @param string $name
   *   The name of the entity.
   *
   * @return \Drupal\rdf_entity\RdfInterface
   *   The RDF entity instance.
   */
  protected function loadRdfEntityByName(string $name): RdfInterface {
    $entities = \Drupal::entityTypeManager()->getStorage('rdf_entity')->loadByProperties(['label' => $name]);
    if (!$entities) {
      throw new \Exception('RDF entity not found.');
    }
    return reset($entities);
  }

  /**
   * Returns the currently logged-in user.
   *
   * @return \Drupal\user\UserInterface
   *   The User entity.
   */
  protected function getCurrentUser(): UserInterface {
    $object = $this->userManager->getCurrentUser();
    if (!$object) {
      return NULL;
    }

    /** @var \Drupal\user\UserInterface $user */
    $user = \Drupal::entityTypeManager()->getStorage('user')->load($object->uid);
    return $user;
  }
}
