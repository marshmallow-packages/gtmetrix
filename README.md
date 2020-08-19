![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# GT Metrix for Laravel Nova
Get GT Metrix information in Laravel Nova for you website pages. This package can also be used stand-alone.

### Installatie
```bash
composer require marshmallow/gtmetrix
```

```env
GTMETRIX_EMAIL_ADDRESS=...
GTMETRIX_API_KEY=...
```

### Prepare your models
1. Add `use Actionable;` and `use GTMetrix;` to your model.
2. Add the public method getFullPublicPath() to your models. When getting the status from GT Metrix, we will use the result of this method as the url you want to check.

### Prepare you nova resources
1. Add `GTMetrixField::make('GT Metrix'),` as a field.
2. Add `new CheckGTMetrixScore,` as an action.
