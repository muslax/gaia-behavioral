# gaia-behavioral

Gaia Behavioral package.

### Devnotes

- Each module must create concrete classes for Evidence and WorkBook specific for its business model.
- Elements objects in concrete modules should be independent from the ones found in, and managed by, central repository. This is to facilitate local customization of element properties that might be useful in many use-cases. (Alias and other custom properties)
- For modules, central repo exists, antara lain, to provide reference and validation. Local elements are independent from repo, but none cant be created without reference to it.