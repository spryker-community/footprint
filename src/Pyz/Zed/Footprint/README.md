# Footprints


Spryker module that generate code base on the existing module footprint template.


## How to Use

1. Copy any existing module into the `templates` directory
2. Modify copied code converting to footprint template
3. Add footprint template configuration, see bellow how to [create a Footprint configuration](#headCreateFootprintConfiguration)
4. Execute console commands with footprint template name and new module name

```ssh
console footprint:make:module CartsRestApi SpecialOffersRestApi
```

5. Follow wizard questions


## <a name="headConvertModuleFootprint"></a>How convert module to Footprint

TBD

## <a name="headCreateFootprintConfiguration"></a>How to create Footprint Configuration

Footprint configuration is a yaml file with the template options and labels.
Template options work as a marker to say what kind of code should or file should be preserved.

```yaml
_should_have_get:
    label: "Would you like to have get method?"
```

where `_should_have_get` is an option name and `label` is an interactive question related to the option.

The option name can be used as method dock block.

```php
    /**
     * @_should_have_get
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        // @todo implement me
        return new RestResponse();
    }

```

or inline comment

```php

  public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
  {
        $resourceRouteCollection
            ->addGet('get') // @_should_have_get
            ->addPost('post') // @_should_have_post
            ->addDelete('delete') // @_should_have_delete
            ->addPatch('patch'); // @_should_have_patch

        return $resourceRouteCollection;
  }

```

or for the whole file putting it under the option directory

```
/templates/CartsRestApi/Glue/CartsRestApi/_should_have_validation
```

## Future Ideas

1. Simplify how to convert Module to Footprint using AI to recognise module structure to extract it

## References

1. https://commercequest.space/discussion/28792/maker-hackathon-mar24
