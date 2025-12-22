# fucodo.registry.editor

This package provides a small editor UI for managing configuration entries of the base registry package `fucodo.registry`.

It extends the configuration of the actual registry — it does not replace it. For the core concepts and configuration schema, see the base package at:
- Packages/Application/fucodo.registry

## What it does
- Reads defaults (labels, descriptions, types, defaults) from `Settings.fucodo.registry.defaults.yaml`.
- Lists entries by namespace/key with human-friendly metadata.
- Lets you edit values via a backend/editor interface.

## Relevant files in this package
- Classes/Domain/Dto/EntryDto.php
- Classes/Controller/EditorController.php
- Resources/Private/Templates/Editor/Edit.html

## Configuration defaults
Define or extend defaults in your Flow settings, e.g.:
- Configuration/Settings.fucodo.registry.defaults.yaml (global)

Each entry can define:
- label
- description
- type (e.g., Text, Boolean)
- default

The editor consumes these for UI rendering. The runtime merge and resolution rules are implemented in `fucodo.registry`.

## Example

```yaml
# add defaults here with the namespace key and then the actual key
# only comes in effect, when no value and no fallback are given
#
fucodo:
  registry:
    defaults:
      KayStrobach_Invoice_NormalInvoiceSettings:    # <--- the namespace
        title:                                    # <--- the key
          type: Text                            # <--- the field type, should be Text
          label:                                # <--- the label (human readable)
          default: Rechnung                     # <--- the default also used from the registry package
          description:                          # <--- the description (human readable)
```

## See also
- Base registry package: fucodo.registry

## License

MIT
