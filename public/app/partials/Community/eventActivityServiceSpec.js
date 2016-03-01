/**
 * @module test.evezownapp
 * @name eventActivityService
 * @description
 * Tests for eventActivityService under evezownapp
 * _Enter the test description._
 * */


describe('Service: evezownapp.eventActivityService', function () {

    // load the service's module
    beforeEach(module('evezownapp'));

    // instantiate service
    var service;

    //update the injection
    beforeEach(inject(function (eventActivityService) {
        service = eventActivityService;
    }));

    /**
     * @description
     * Sample test case to check if the service is injected properly
     * */
    it('should be injected and defined', function () {
        expect(service).toBeDefined();
    });
});
