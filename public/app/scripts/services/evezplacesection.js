'use strict';

/**
 * @ngdoc service
 * @name appApp.evezplaceSection
 * @description
 * # evezplaceSection
 * Service in the appApp.
 */
evezownApp
    .service('evezplaceSectionService', function () {
        var evezplaceSectionService = {};

        evezplaceSectionService.getSectionId = function (index) {
            var sectionId;

            if (index == 0) {
                sectionId = 3;
            }

            if (index == 1) {
                sectionId = 4;
            }

            if (index == 2) {
                sectionId = 6;
            }

            if (index == 3) {
                sectionId = 5;
            }

            return sectionId;
        };

        return evezplaceSectionService;
    });
