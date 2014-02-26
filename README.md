Imagen
======

A GD image manipulation library with the aim of allowing you to create dynamic images with the GD library

Currently in an alpha testing phase

If you have an feedback please either raise an issue or email me [here](mailto:christopher.rolfe198@gmail.com)

Usage
=====


These classes can be used for basic manipulation of images. This includes cropping, resizing and overlaying text and images.

Before doing most things you should create an instance of BaseImage to pass around into the resize/crop classes.

`$baseimage = new BaseImage('Path/To/Image/File.(png|jpg|gif)');`

Currently png, jpg and gif support has been added but potentially any types of images supported via GD can be used.

You then create a resize or crop object which can use the base image instance.

```php
$resize = new Resize($BaseImage);
$resize->resize(200,200);

$crop = new Crop($baseimage);
$crop->crop(200,200);
```

Namespaces
----------
If you run into trouble with classes not being recognised you need to make sure you have set the appropriate namespaces up.

BaseImage - ThatChrisR\Imagen\Base\BaseImage;

Resize - ThatChrisR\Imagen\Resize\Resize;

Crop - ThatChrisR\Imagen\Crop\Crop;

ImageOverlay - ThatChrisR\Imagen\Overlay\ImageOverlay;

TextOverlay - ThatChrisR\Imagen\Overlay\TextOverlay;
