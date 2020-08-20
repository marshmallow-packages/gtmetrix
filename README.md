![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# GT Metrix for Laravel Nova
Get GT Metrix information in Laravel Nova for you website pages. This package can also be used stand-alone.

# How does it work?
You create an account on GT Metrix. Once you have an API key you are good to go. You can add this library on every resource you want to, as long as it has a public url connected to it so we can get the GT Metrix score for that url.


## Index view
<p>
On the index page we show an avarage score of the `Pagespeed` score and the `Yslow` score.
</p>
<img src="https://gitlab.com/marshmallow-packages/nova/gtmetrix/-/raw/master/resources/screenshots/index-view.png">

## Detail view
<p>
On the detail view we will show the `Pagespeed` score and the `Yslow` score. You can click on them to go to the full report on the GTmetrix.com website.
</p>
<img src="https://gitlab.com/marshmallow-packages/nova/gtmetrix/-/raw/master/resources/screenshots/detail-view.png">

## Action
<p>
On the detail view you will be able to start an action. This action is queued so make sure you have a worker running. This is needed because the changes of a timeout are big if its busy at GTmetrix.
</p>
<img src="https://gitlab.com/marshmallow-packages/nova/gtmetrix/-/raw/master/resources/screenshots/action-view.png">
<p>
Once you've selected the action to get a new score you will get a popup telling you how much credits you have left and if you are sure you want to spend another credit.
</p>
<img src="https://gitlab.com/marshmallow-packages/nova/gtmetrix/-/raw/master/resources/screenshots/action-popup.png">

### Installation
Pull in the library using composer.
```bash
composer require marshmallow/gtmetrix
```

Update your `.env` file and add the to env properties listed below.
```env
GTMETRIX_EMAIL_ADDRESS=...
GTMETRIX_API_KEY=...
```

### Prepare your models
1. Add `use Actionable;` and `use GTMetrix;` to your model.
```php
namespace App;

use Laravel\Nova\Actions\Actionable;
use Marshmallow\GTMetrix\Traits\GTMetrix;

class Post extends Model
{
    use GTMetrix;
    use Actionable;
    // ...
```
2. Add the public method `getFullPublicPath()` to your models. When getting the status from GT Metrix, we will use the result of this method as the url you want to check.
```php
class Post extends Model
{
    // ...

    public function getFullPublicPath()
    {
        return 'https://marshmallow.dev/' . $this->slug;
    }
}
```

### Prepare your nova resources
1. Add `GTMetrixField::make('GT Metrix'),` as a field.
```php
use Marshmallow\GTMetrix\GTMetrixField;

public function fields(Request $request)
{
    return [
        ID::make(__('ID'), 'id')->sortable(),
        GTMetrixField::make('GT Metrix'),
    ];
}
```

2. Add `new CheckGTMetrixScore,` as an action.
```php
use Marshmallow\GTMetrix\Actions\CheckGTMetrixScore;

public function actions(Request $request)
{
    return [
        new CheckGTMetrixScore,
    ];
}
```
