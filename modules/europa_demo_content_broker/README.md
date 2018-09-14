This module is used in order to "mock" the part of the Kafka Pod responsible for
restricting content from the triple store on a given site. 

## How to use

The module is installed and enabled on each demo site. In doing so, it provides
a configuration object (empty to start with) that needs to be overridden in each
site's settings.php in order to provide the rules for brokering the content.

The configuration is represented as an array of hashes which contain the site
provenance URI with the corresponding topics (RDF entity bundles) it should consume from that site.

Example of settings.php config override:

```
$config['europa_demo_content_broker.settings']['topics'] = [
  [
    'site' => 'http://web:8080/sites/inea/web',
    'topics' => [],
  ],
  [
    'site' => 'http://web:8080/sites/energy/web',
    'topics' => [
      'oe_announcement',
    ]
  ],
];
```

In the above example, the site will be able to consume RDF entities as such:

* Any topics from the site with the Provenance URI: `http://web:8080/sites/inea/web`
* Announcements from site with the Provenance URI: 'http://web:8080/sites/energy/web'

### Notes

* Leaving the topics key empty indicates that any topics are consumable from that site
* Not specifying a site (hash of data provenance URI + topics) means that no RDF entities can be consumed from that site