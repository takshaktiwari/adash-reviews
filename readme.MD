# Introduction

An extension to <a href="https://github.com/takshaktiwari/adash">takshaktiwari/adash</a> form reviews system. This can be attached to any any model of your application and it's fully customizable.

# Implementation

Install the package with composer with given command and run the migrations `php artisan migrate`

    composer require takshak/adash-review

Publish config file, views and components for further customization

    php artisan vendor:publish --provider=Takshak\Areviews\AreviewsServiceProvider

Add component to admin sidebar, inside `ul` element for getting the links in admin sidebar

    <x-areviews-areviews:admin-sidebar-links />

Use `Takshak\Areviews\Traits\Models\ReviewModelTrait` to those model in which you want to implement the reviews system. This will help you to get the rating and reviews of the model. If the model is _$product_, rating of the model will be accessed by `$product->rating` and reviews by `$product->reviews`.

Now all setup is done, you can use other components according to your requirements.

# Components

## Admin sidebar menu

**<x-areviews-areviews:admin-sidebar-links />:** Use this component to show the menu item in admin sidebar

## Listing reviews

**<x-areviews-areviews:reviews ..... />:** This component will be useful to show the list of reviews. You can list your own reviews or default latest reviews with or without pagination. Default display style will be masonry using bootstrap rows and columns. You can further customize this component after publishing the assets. There are some arguments with this component which may help you in achieving your desired format:

-  **reviews:** Pass the collection of reviews which you have already digged out from the database. Only these reviews will be shown in the list.

-  **model:** Pass the model instance for which you want to get the reviews. _Note:_ Please check if you have already used `ReviewModelTrait` trait to the model. You will only see the reviews of the model when first `reviews` argument is not passed or is empty.

-  **limit:** This argument will limit the reviews which we got from `reviews` or `model` argument. This will also act as count of per page in case of `pagination `. Default limit value is **10**.

-  **column:** Use the column classes to control the number of columns in listing. Default value is `col-lg-4 col-md-6`. It will show 3 columns on large screen, 2 in medium screen and single column in small or mobile devices. You can pass your own column classes to control the columns. You can also define it globally in config file.

-  **paginate:** Put the value `true` or `false` to get pagination feature on listing. This will only work if you are getting the reviews from `model` argument not from `reviews` argument.

### Example:

Getting the latest 6 reviews from all models.

    <x-areviews-areviews:reviews limit="6" />

Getting all reviews of a product with pagination.

    <x-areviews-areviews:reviews :model="$product" limit="20" :paginate="true" />

## Getting reviews form

**<x-areviews-areviews:review-form ..... />:** This component can used to store or edit the reviews. There are some arguments by which you can change the functionalities. Some fields can be removed just by changing fields array in config.

- **model:** Pass the model for which you want to associate the review.

- **review:** An existing review wil be passed to populate the fields. This can be used in case you are editing the review.

- **url:** Put the url on which you want to submit the form. By default form will be submitted to the default url. Only pass the value if you want to change the submission url.

- **method:** Default method is `POST`, if you want to change the form method you can pass `PUT` if you are editing the review.

- **redirect:** Form will be redirected back to the form after submission. If you want to goto some other page after form submission, you can pass the destination url here.

**Example**

    // for storing the review.
    <x-areviews-areviews:review-form :model="$product" />

    // for editing the review with other arguments
    <x-areviews-areviews:review-form
        method="PUT"
        :model="$review->reviewable"
        :review="$review"
        :url="route('admin.reviews.update', [$review])"
        :redirect="route('admin.reviews.index')" />


## Show a single review

**<x-areviews-areviews:review-card ..... />:** This will display a review item, an argument named `review` will be passed with the review model which will be shown.
eg. `<x-areviews-areviews:review-card :review="$review" />`
