<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Gherkin\Node\TableNode;
use Drupal\DrupalExtension\Context\RawDrupalContext;
use Drupal\rdf_entity\RdfInterface;
use Drupal\user\UserInterface;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Drupal\taxonomy\TermInterface;

/**
 * Defines step definitions specifically for testing the RDF entities.
 */
class RdfEntityContext extends RawDrupalContext {

  /**
   * An array of RDF entities we need to keep track to delete.
   *
   * @var \Drupal\rdf_entity\RdfInterface[]
   */
  protected $rdfEntities = [];

  /**
   * After scenario hook to delete the RDF entities.
   *
   * @param \Behat\Behat\Hook\Scope\AfterScenarioScope $scope
   *   The Hook scope.
   *
   * @AfterScenario
   */
  public function afterScenarioRdfCleanUp(AfterScenarioScope $scope): void {
    foreach ($this->rdfEntities as $rdf) {
      $rdf->delete();
    }

    $this->rdfEntities = [];
  }

  /**
   * User creation and login for creating RDF entities.
   *
   * A custom step that creates a user that has the permissions to manage and
   * view RDF entities of a give type.
   *
   * @Given I am logged in with a user that can access the RDF content overview
   *   page
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
   * Creates announcements tagging it with given subjects.
   *
   * @Given the following announcements:
   */
  public function createAnnouncements(TableNode $table) {
    foreach ($table->getColumnsHash() as $fields) {
      $term = $this->getSubjectByName($fields['subject']);
      $values = [
        'bundle' => 'Announcement',
        'label' => $fields['title'],
        'oe_announcement_department' => 'http://publications.europa.eu/resource/authority/organization-type/AGENCY_EXE',
        'oe_announcement_location' => 'Brussels',
        'oe_announcement_subject' => $term->id(),
        'oe_announcement_type' => 'http://publications.europa.eu/resource/authority/resource-type/PRESS_REL',
      ];

      $this->createRdfEntity($values);
    }
  }

  /**
   * Creates keeps track of an RDF entity.
   *
   * @param array $values
   *   Values for the RDF entity.
   *
   * @return \Drupal\rdf_entity\RdfInterface
   *   The entity.
   */
  protected function createRdfEntity(array $values): RdfInterface {
    $bundle = isset($values['bundle']) ? $values['bundle'] : NULL;
    if (!$bundle) {
      throw new \InvalidArgumentException('No bundle provided.');
    }

    /** @var \Drupal\rdf_entity\RdfEntityTypeInterface[] $types */
    $types = \Drupal::entityTypeManager()->getStorage('rdf_type')->loadMultiple();
    $map = [];
    foreach ($types as $id => $type) {
      $map[$type->label()] = $type->id();
    }

    if (!isset($map[$bundle])) {
      throw new \InvalidArgumentException('The provided entity type is not correct.');
    }

    $values += [
      'rid' => $map[$bundle],
    ];

    /** @var \Drupal\rdf_entity\RdfInterface $entity */
    $entity = \Drupal::entityTypeManager()->getStorage('rdf_entity')->create($values);
    $entity->save();
    $this->rdfEntities[] = $entity;
    return $entity;
  }

  /**
   * Returns the Subject taxonomy term by name.
   *
   * @param string $name
   *   The name of the subject.
   *
   * @return \Drupal\taxonomy\TermInterface
   *   The taxonomy term.
   */
  protected function getSubjectByName(string $name): TermInterface {
    // We need to reference the Subject term.
    $subjects = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['name' => $name]);
    if (!$subjects) {
      throw new \Exception('There was no subject found by the name: ' . $name);
    }

    return reset($subjects);
  }

  /**
   * Returns the Department taxonomy term by name.
   *
   * @param string $name
   *   The name of the department.
   *
   * @return \Drupal\taxonomy\TermInterface
   *   The taxonomy term.
   */
  protected function getDepartmentByName(string $name): TermInterface {
    // We need to reference the Department term.
    $departments = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['name' => $name]);
    if (!$departments) {
      throw new \Exception('There was no department found by the name: ' . $name);
    }

    return reset($departments);
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
