# Statamic Instagram Feed ![Statamic 3](https://img.shields.io/badge/statamic-3-blue.svg?style=flat-square)

📸 **Easily embed an instagram feed in your Statamic site** 📸

### This version of the addon is only for Statamic 3+

_This addon adds a fieldtype which gets images from instagram profiles. It uses web scraping under the hood, so beware, if Instagram changes something it may have issues! Generally, it's pretty stable._

**For example:**

```
{{ instagram_feed limit="3" }}
    <img src="{{ image }}">
{{ /instagram_feed }}
```

## Requirements

- Statamic 3
- Instagram credentials for an account with Multi-factor auth turned OFF

## Installation

Require the package with composer:

```
composer require austenc/statamic-instagram-feed
```

## Configuration

You need to configure an Instagram username and password. Optionally, you can
include a different profile for the feed to display.

Set the username/password `.env` file

```sh
INSTAGRAM_USERNAME='your-username'
INSTAGRAM_PASSWORD='your-password'
```

> The username and password do not have to match the profile displayed, as long as the account can view the profile.

## Usage

After configuring your Instagram username and password, use the `{{ instagram_feed }}` tag:

```
{{ instagram_feed }}
    <img src="{{ image }}">
{{ /instagram_feed }}
```

> You may also use the `limit` parameter to restrict the number of recent posts

## Post Fields

Each post in the feed contains a number of fields for you to use.

| Field      | Description                              |
| ---------- | ---------------------------------------- |
| `id`       | The post's Instagram ID                  |
| `image`    | The URL of the image                     |
| `caption`  | The caption of the post                  |
| `thumb`    | The URL for the post's thumbnail         |
| `date`     | The date it was posted                   |
| `comments` | The total number of comments on the post |
| `likes`    | The total number of likes on the post    |
| `link`     | The full URL to the post                 |
| `height`   | The image's height                       |
| `width`    | The image's width                        |

## Available Parameters

| Option    | Default Value | Description                        |
| --------- | ------------- | ---------------------------------- |
| `limit`   | `12`          | The number of recent posts to pull |
| `profile` | `null`        | The Instagram profile to display   |

## Support

Find a bug? Have a feature request? I'd be happy to help! Open an issue [on github](https://github.com/austenc/statamic-instagram-feed)
or reach out on twitter [@austencam](https://twitter.com/austencam) and I will get back to you when I can.
