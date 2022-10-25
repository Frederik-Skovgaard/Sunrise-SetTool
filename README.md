
# Introduction
### Sunrise/Sunset Tool
Users can choice city and/or date, to receive the corresponding sunrise/set times,
for each day op to the nearest Sunday.
# Shortcuts
*  **Change Log Updates**
    * [Change log](#Change-log)
        * [Unreleased](#Unreleased)
            * [Version 0.3.0](#Version-0.3.0)
                * [Added](#Version-0.3.0\Added)
                * [Changes](#Version-0.3.0\Changes)
            * [Version 0.2.0](#Version-0.2.0)
                * [Added](#Version-0.2.0\Added)
            * [Version 0.1.0](#Version-0.1.0)
                * [Added](#Version-0.1.0\Added)
*  **Infomation**
    * [Compatibility](#Compatibility)
        * [Browser Compatibility](#Browser-Compatibility)
    * [API's Used](#API's-Used)
        * [Sunset and sunrise times API](#Sunset-and-sunrise-times-API)
        * [OpenWeatherAPI](#OpenWeatherAPI)
    * [User Guide](#User-Guide)
        * [Get Sunrise/Set By City Name](#Get-Sunrise/Set-By-City-Name)
        * [Get Sunrise/Set For Specific Days](#Get-Sunrise/Set-For-Specific-Days)

# Compatibility
### Browser Compatibility
- [x] Opera
- [x] Google Chrome
- [x] Microsoft Edge

# API's Used
### [Sunset and sunrise times API](https://sunrise-sunset.org/api)

* Get sunrise/set times
### [OpenWeatherAPI](https://openweathermap.org/current)
* Get latitude and longitude by city name
# User Guide
### Get Sunrise/Set By City Name
Type name of city  you wish to receive data from into the input field.
Then press "Update" button to load data.

### Get Sunrise/Set For Specific Days
Select date in the date picker under the text input field.
Then press "Update" button to load data.

# Change log
# [Unreleased]
## Version 0.3.0
### Changes
- [x] Call to sunset/rise API in a for loop to get data for todays date or custom date til next Sunday.
- [x] POST now calls a function instead of running all the code there.
### Added
- [x] Input field for custom date.
- [x] Function to calculate days between to days.
## Version 0.2.0
### Added
- [x] Call to Sunset and sunrise times API to get sunrise/set times.
- [x] Bootstrap Cards for Data.
- [x] CSS styling for page.
## Version 0.1.0
### Added
- [x] HTML layout.
- [x] Input fields for city name.
- [x] Call to OpenWeatherAPI to get Latitude and Longitude from city name.