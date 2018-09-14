Feature: RDF content 'oe_event'
  In order to be able to showcase the rdf content according the broker
  As an Anonymous
  I want to make sure that the rdf default content is correctly shared

  @site-inea
  Scenario Outline: Check visibility of 'oe_event'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                          | title                                   |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f5b829070_bbd2b_b4caa_b828c_b43342432b51a | Horizon 2020 Energy info day            |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f8753edac_bf3b9_b45a7_b8c9f_b38ce9134f608 | EU Sustainable Energy Week (EUSEW) 2018 |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fae827102_b2beb_b4338_b943e_b80f56358a6bf | Access denied                           |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fd9a9d634_b13ac_b493f_bbc18_b7b750b9698ed | Access denied                           |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fe424d10b_be8bc_b49c9_ba9d1_bf64511d73e6f | Access denied                           |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_ff8115b40_b12d7_b4c6d_bae4e_b0b9538a9bfc4 | Horizon 2020 Transport virtual info day |

  @site-info
  Scenario Outline: Check visibility of 'oe_event'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                          | title                                          |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f5b829070_bbd2b_b4caa_b828c_b43342432b51a | Access denied                                  |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f8753edac_bf3b9_b45a7_b8c9f_b38ce9134f608 | Access denied                                  |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fae827102_b2beb_b4338_b943e_b80f56358a6bf | Financing Energy Efficiency in Malta and Italy |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fd9a9d634_b13ac_b493f_bbc18_b7b750b9698ed | EU Energy Day at COP24, COP24 EU Pavilion      |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fe424d10b_be8bc_b49c9_ba9d1_bf64511d73e6f | EU Green Week 2019                             |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_ff8115b40_b12d7_b4c6d_bae4e_b0b9538a9bfc4 | Access denied                                  |

  @site-energy
  Scenario Outline: Check visibility of 'oe_event'
    When I am on "/en/rdf_entity/<path>"
    
    # Then I should see "<title>" in the "breadcrumb" region
    And I should see the heading "<title>" in the "page header" region

    Examples:
    | path                                                                                                          | title                                          |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f5b829070_bbd2b_b4caa_b828c_b43342432b51a | Horizon 2020 Energy info day                   |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_f8753edac_bf3b9_b45a7_b8c9f_b38ce9134f608 | EU Sustainable Energy Week (EUSEW) 2018        |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fae827102_b2beb_b4338_b943e_b80f56358a6bf | Financing Energy Efficiency in Malta and Italy |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fd9a9d634_b13ac_b493f_bbc18_b7b750b9698ed | EU Energy Day at COP24, COP24 EU Pavilion      |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_fe424d10b_be8bc_b49c9_ba9d1_bf64511d73e6f | EU Green Week 2019                             |
    | http_e_f_flocalhost_e8080_fsites_finea_fweb_frdf_aentity_foe_aevent_ff8115b40_b12d7_b4c6d_bae4e_b0b9538a9bfc4 | Horizon 2020 Transport virtual info day        |