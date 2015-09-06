#### File Upload
 - Multiple file/image upload
 - Add `type` param to a file upload request
 - Add `type` configuration (?)
 - File upload validation (in `UploadController`) based on `type` and configuration rules (use mime, image...)
 - File upload manipulation based on `type` (e.g. resize, crop and else) (?)

May be move all `type`-depending logic to the separate package and leave included controller simple?

#### Theming
 - Move all Bootstrap-related stuff from FormBuilder to themes and add Foundation theme (?)

#### New Fields
 - wysiwyg
 - video (consider jquery upload realisation)
 - audio (+ multiple audio)
 - sir trevor (?)

 #### Other
 - multiplicator. Allow every field (->text() based) be multiple. to think about divider escaping (?)
