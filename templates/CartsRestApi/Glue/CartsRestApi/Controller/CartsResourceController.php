<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CartsRestApi\Controller;

use Generated\Shared\Transfer\RestCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Spryker\Glue\CartsRestApi\CartsRestApiFactory getFactory()
 */
class CartsResourceController extends AbstractController
{
    /**
     * @_should_have_get
     *
     * @Glue({
     *     "getResourceById": {
     *          "summary": [
     *              "Retrieves a cart by id."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "404": "Cart not found.",
     *              "403": "Missing access token."
     *          }
     *     },
     *     "getCollection": {
     *          "deprecated": true,
     *          "summary": [
     *              "Retrieves list of all customer's carts."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }]
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        // @todo implement me
        return new RestResponse();
    }

    /**
     * @_should_have_post
     *
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Creates a cart."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "403": "Unauthorized cart action.",
     *              "422": "Customer already has a cart."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCartsAttributesTransfer $restCartsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest, RestCartsAttributesTransfer $restCartsAttributesTransfer): RestResponseInterface
    {
        // @todo implement me
        return new RestResponse();
    }

    /**
     * @_should_have_delete
     *
     * @Glue({
     *     "delete": {
     *          "summary": [
     *              "Deletes cart by id."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "400": "Cart id is missing.",
     *              "403": "Unauthorized cart action.",
     *              "404": "Cart not found.",
     *              "422": "Cart could not be deleted."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        // @todo implement me
        return new RestResponse();
    }

    /**
     * @_should_have_patch
     *
     * @Glue({
     *     "patch": {
     *          "summary": [
     *              "Updates a cart."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "400": "Cart id is missing.",
     *              "403": "Unauthorized cart action.",
     *              "404": "Cart with given uuid not found.",
     *              "422": "Can’t switch price mode when there are items in the cart."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCartsAttributesTransfer $restCartsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(RestRequestInterface $restRequest, RestCartsAttributesTransfer $restCartsAttributesTransfer): RestResponseInterface
    {
        // @todo implement me
        return new RestResponse();
    }
}
