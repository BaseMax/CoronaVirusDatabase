# Corona Virus Database

A repository for analyzing references and database of `gisanddata.maps.arcgis.com` website for Corona Virus.

# Corona Virus

Website: https://gisanddata.maps.arcgis.com/apps/opsdashboard/index.html#/bda7594740fd40299423467b48e9ecf6

Downloadable database: GitHub: [Here](https://github.com/CSSEGISandData/COVID-19/tree/master/archived_data).

There is a `csv` files for every day. e.g: https://github.com/CSSEGISandData/COVID-19/tree/master/csse_covid_19_data

But main site has not get data from that.

By checking main website, I did check all requests and links:

Finaly I found this:

https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/2/query?f=json&where=Confirmed%20%3E%200&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc&resultOffset=0&resultRecordCount=1000&cacheHint=true

But you can see all requests as HAR format at [here](requests.har).


## Features

- Free, Open Source, Easy and short code
- Ability to create token for suers
- Ability to search in country
- Ability to sort (ASC or DESC) in country list
- Ability to get total number (in world)
- Ability to limit auth and token

## COVID19 API

All request need `token` value in header, You can create `token` in **token** table.

### Country List

**GET:** http://localhost/CoronaVirusDatabase/?method=list

**POST:** http://localhost/CoronaVirusDatabase/ with `method=list` data

```json
{
	status: "success",
	message: "",
	lastUpdate: "2020-02-27 18:05:06",
	result: [
		{
		id: 1,
		name: "china",
		totalCase: 78514,
		newCase: 450,
		totalDeath: 2747,
		newDeath: 32,
		totalRecovered: 32954,
		seriousUser: 8346,
		datetime: "2020-02-27 18:05:03"
		},
		...
	]
}
```

### Country List with Sort

##### DESC sort:

**GET:** http://localhost/CoronaVirusDatabase/?method=list&sort=totalCase&type=desc

**POST:** http://localhost/CoronaVirusDatabase/ with `method=list&sort=totalCase&type=desc` data

##### or ASC sort:

**GET:** http://localhost/CoronaVirusDatabase/?method=list&sort=totalCase&type=asc

**POST:** http://localhost/CoronaVirusDatabase/ with `method=list&sort=totalCase&type=asc` data

### Search in country

**GET:** http://localhost/CoronaVirusDatabase/?method=search&query=ir

**POST:** http://localhost/CoronaVirusDatabase/ with `method=search&query=ir`

```json
{
	status: "success",
	message: "",
	result: [
		{
			id: 5,
			name: "iran",
			totalCase: 245,
			newCase: 106,
			totalDeath: 26,
			newDeath: 7,
			totalRecovered: 25,
			seriousUser: 0,
			datetime: "2020-02-27 16:05:56"
		},
		{
			id: 24,
			name: "iraq",
			totalCase: 6,
			newCase: 1,
			totalDeath: 0,
			newDeath: 0,
			totalRecovered: 0,
			seriousUser: 0,
			datetime: "2020-02-27 16:05:59"
		}
	]
}
```

### Search in country with sort

**GET:** http://localhost/CoronaVirusDatabase/?method=search&query=ir&sort=totalCase&type=asc

**POST:** http://localhost/CoronaVirusDatabase/ with `method=search&query=ir&sort=totalCase&type=asc` data


### Total numbers in all country and in the world

**GET:** http://localhost/CoronaVirusDatabase/?method=total

**POST:** http://localhost/CoronaVirusDatabase/ with `method=total`

```json
{
	status: "success",
	message: "",
	result: {
		all: "163492",
		died: "5588"
	}
}
```

## Installing / Using from COVID19 API

- Download source files
- Upload sources files in a webserver (e.g: `/var/www/html` or `/usr/share/nginx/html` or ...)
- Create a database for this project
- Put username, password and database name in `_core.php` file and config this project by modify `_core.php` file
- Import `corona.sql` file into your database (using phpmyadmin or mariadb, mysql cli or other tools)

> Note: corona.sql is database structure with empty table, you will use it to setup this project. But output.sql is a database output with current corona data.

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
