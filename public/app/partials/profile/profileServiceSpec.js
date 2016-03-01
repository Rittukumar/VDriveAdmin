/**
 * @module test.evezownapp
 * @name profileService
 * @description
 * Tests for profileService under evezownapp
 * _Enter the test description._
 * */


describe('Service: evezownapp.profileService', function () {

    // load the service's module
    beforeEach(module('evezownapp'));

    // instantiate service
    var service;

    //update the injection
    beforeEach(inject(function (profileService) {
        service = profileService;
    }));

    /**
     * @description
     * Sample test case to check if the service is injected properly
     * */
    it('should be injected and defined', function () {
        expect(service).toBeDefined();
    });
});
