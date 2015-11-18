#### File Upload
 - Multiple file/image upload
 - Add method to add custom error handlers (client side)
 - File upload manipulation based on `type` (e.g. resize, crop and else) (?)
 - fix files without extension

May be move all the `type`-depending logic to the separate package and leave the included one simple as possible?

#### Theming
 - Move all Bootstrap-related stuff from FormBuilder to themes and add Foundation theme (?)

#### New Fields
 - wysiwyg
 - video (consider jquery upload realisation)
 - audio (+ multiple audio)
 - sir trevor (?)

#### Other
 - multiplicator. Allow every field (`->text()` based) be multiple. to think about divider escaping (?)
 - Configurable default geopoint options
 - replace defalt fields methods with `__call` and `->defaultField`
 - rename to `rutorika-laravel-form` (?)
