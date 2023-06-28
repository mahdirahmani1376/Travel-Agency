this project is bases by the laravel daily course https://laraveldaily.com/lesson/travel-api/client-specification-into-plan-of-action

This is a laravel project based on this client specifications

A private (admin) endpoint to create new users. If you want, this could also be an artisan command, as you like. It will mainly be used to generate users for this exercise;
A private (admin) endpoint to create new travels;
A private (admin) endpoint to create new tours for a travel;
A private (editor) endpoint to update a travel;
A public (no auth) endpoint to get a list of paginated travels. It must return only public travels;
A public (no auth) endpoint to get a list of paginated tours by the travel slug (e.g. all the tours of the travel foo-bar). Users can filter (search) the results by priceFrom, priceTo, dateFrom (from that startingDate) and dateTo (until that startingDate). User can sort the list by price asc and desc. They will always be sorted, after every additional user-provided filter, by startingDate asc.
Models
Users

ID
Email
Password
Roles (M2M relationship)
Roles

ID
Name
Travels

ID
Is Public (bool)
Slug
Name
Description
Number of days
Number of nights (virtual, computed by numberOfDays - 1)
Tours

ID
Travel ID (M2O relationship)
Name
Starting date
Ending date
Price (integer, see below)
