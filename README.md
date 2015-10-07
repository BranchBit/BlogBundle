BlogBundle
=====================


A **very simple** blogbundle for symfony2. **STILL A WORK IN PROGRESS**

Can be seen live at [http://branchbit.be/blog](http://branchbit.be/blog)


### Step 1: Download BBITBlogBundle using composer

Add BBITBlogBundle in your composer.json:

```js
{
    "require": {
        "knplabs/knp-markdown-bundle": "~1.3",
        "eko/feedbundle":  "dev-master",
        "bbit/blog-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundles by running the command:

``` bash
$ php composer.phar install
```

Composer will install the bbit/blog-bundle bundle to your project's `vendor/BBIT` directory.

### Step 2: Enable the bundles

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
        new Eko\FeedBundle\EkoFeedBundle(),
        new BBIT\BlogBundle\BBITBlogBundle(),
    );
}
```


### Step 3: Config

```
bbit_blog:
    extend_template: 'AcmeWebsiteBundle:Default:layout.html.twig' #should contain a block called 'blogContent'
    disqus_shortname: 'AcmeBlog'
    addthis_pubid: 'ra-55cxxxxxxxxx648'
    btn_class: 'btn-buy hover-effect'
    eko_feed:
        feeds:
            post:
                title:       'Acme Blog Feed'
                description: 'Acme blog Feed Description'
                link:
                    route_name: bbit_blog_rss_view
                encoding:    'utf-8'
```
### Step 4: 

Update your database.

Add BBITBlogBundle to the assetic.bundle config

Add routing file:
```
bbit_blog:
    resource: "@BBITBlogBundle/Resources/config/routing.yml"
    prefix:   /blog/
```

### Step 5: Add content

A very simple limited admin-CRUD is located at `/blog/admin/post`.

Posts are rendered in [markdown](https://en.wikipedia.org/wiki/Markdown).

### Step 6: View content

Blog is located at `/blog`.

Rss feed is located at `/blog/rss`.







Supports ["Engage by Disqus"](http://publishers.disq.us/engage) for comments.

Supports ["AddThis"](https://www.addthis.com/get/sharing) for sharing.


