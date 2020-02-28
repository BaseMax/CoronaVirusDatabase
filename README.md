# Matno Contest - Back-End Programming

# Corona Virus Database

A repository for analyzing references and database of `gisanddata.maps.arcgis.com` website for Corona Virus.

# Corona Virus

Website: https://gisanddata.maps.arcgis.com/apps/opsdashboard/index.html#/bda7594740fd40299423467b48e9ecf6

Downloadable database: GitHub: [Here](https://github.com/CSSEGISandData/COVID-19/tree/master/archived_data).

There is a `csv` files for every days. e.g: https://github.com/CSSEGISandData/COVID-19/blob/master/archived_data/test/02-26-2020.csv

But main site has not get data from that.

By checking main website, i did check all requests and links:

Finaly i found this:

https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/2/query?f=json&where=Confirmed%20%3E%200&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc&resultOffset=0&resultRecordCount=1000&cacheHint=true

But you can see all requests as HAR format at [here](requests.har).

## How keep data live and up to date?

Run `$ php _update.php update` every time you want to update your database rows.
It will automaticly update and change data, if they are new or changed!

## Using crontab to automaticly update results

Crontab command: `* */2 * * * php _update.php >/dev/null 2>&1`

Current time is: 2020-02-26 7:29:00 PM UTC

This cron job will be run at: (5 times displayed and more...)

- 2020-02-26 20:00:00 UTC
- 2020-02-26 20:01:00 UTC
- 2020-02-26 20:02:00 UTC
- 2020-02-26 20:03:00 UTC
- 2020-02-26 20:04:00 UTC
- ...

----------

# COVID-19 CORONAVIRUS OUTBREAK

# Corona Virus Outbreak API

A tiny and small program to crawler and analyze outbreak of COVID-19 in world and every country using PHP.

## Confirmed Cases and Deaths by Country, Territory, or Conveyance

The novel coronavirus COVID-19 is affecting 45 countries and territories around the world and 1 international conveyance (the "Diamond Princess" cruise ship harbored in Yokohama, Japan).

The bulk of China's new cases and deaths are reported after 22:00 GMT (5:00 PM ET) for Hubei (lately with delays of up to 2 hours), and after 00:00 GMT (7:00 PM ET) for the rest of China (lately with delays of up to 9 hours).

---------

# Max Base

My nickname is Max, Programming language developer, Full-stack programmer. I love computer scientists, researchers, and compilers. ([Max Base](https://maxbase.org/))

## Asrez Team

A team includes some programmer, developer, designer, researcher(s) especially Max Base.

[Asrez Team](https://www.asrez.com/)
