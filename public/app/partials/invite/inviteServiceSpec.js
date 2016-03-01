/**
 * @module test.evezownapp
 * @name inviteService
 * @description
 * Tests for inviteService under evezownapp
 * _Enter the test description._
 * */


describe('Service: evezownapp.inviteService', function () {

    // load the service's module
    beforeEach(module('evezownapp'));

    // instantiate service
    var service;

    //update the injection
    beforeEach(inject(function (inviteService) {
        service = inviteService;
    }));

    /**
     * @description
     * Sample test case to check if the service is injected properly
     * */
    it('should be injected and defined', function () {
        expect(service).toBeDefined();
    });
});
