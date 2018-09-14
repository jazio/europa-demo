Feature: RDF content 'oe_announcement'
  In order to be able to showcase the rdf content according the broker
  As an Anonymous
  I want to make sure that the rdf default content is correctly shared

  @site-info @site-inea @site-energy
  Scenario Outline: Check visibility of 'oe_announcement'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                                 | title                                                                             |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aannouncement_f2236b3d4_bb988_b4614_ba093_b920ba4633b97 | Over €300 million available now to energy projects                                |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aannouncement_f26f49f73_bb0b4_b4c84_b9606_ba0e3f678cd14 | EU-funded researchers set a new energy efficiency record for solar cells          |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aannouncement_f36f2e2a8_bf517_b4277_b901c_b1648de2c8363 | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |