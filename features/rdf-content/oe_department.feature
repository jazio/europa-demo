Feature: RDF content 'oe_department'
  In order to be able to showcase the rdf content according the broker
  As an Anonymous
  I want to make sure that the rdf default content is correctly shared

  @site-info @site-energy
  Scenario Outline: Check visibility of 'oe_department'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                               | title                                    |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f9d5ebd97_b408a_b4b85_bb177_bb691abcdf6ba | Directorate-General for Energy           |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f587c717e_bcf1f_b4c74_b9b58_bd00bf04897d7 | Innovation and Networks Executive Agency |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f02b660ea_b22af_b48e3_bbb62_bfead0269d1f6 | Directorate-General for Environment      |

  @site-inea
  Scenario Outline: Check visibility of 'oe_department'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                               | title         |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f9d5ebd97_b408a_b4b85_bb177_bb691abcdf6ba | Access denied |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f587c717e_bcf1f_b4c74_b9b58_bd00bf04897d7 | Access denied |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_adepartment_f02b660ea_b22af_b48e3_bbb62_bfead0269d1f6 | Access denied |