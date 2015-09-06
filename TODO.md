#### File Upload
 - Multiple file/image upload
 - Add `type` param to a file upload request
 - Add `type` configuration (?)
 - File upload validation (in `UploadController`) based on `type` and configuration rules (use mime, image...)
 - Add method to add custom error handlers
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



 <VirtualHost *:80>
   DocumentRoot "/home/xu/Workspace/demo-rutorika-laravel-html/public"
   ServerRoot "/home/xu/Workspace"
   ServerName laravel-html.boxfrommars.ru

   <Directory "/home/xu/Workspace/demo-rutorika-laravel-html/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
</VirtualHost>
